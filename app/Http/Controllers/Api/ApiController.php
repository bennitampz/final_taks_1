<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        // Menggunakan validator untuk penanganan error yang lebih baik
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|string|email:rfc,dns|unique:users,email|max:255',
            'password' => 'required|string|min:6|max:255|confirmed',
            'password_confirmation' => 'required'
        ]);

        // Jika validasi gagal, kembalikan respon error
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Membuat pengguna baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            // Membuat token akses
            $token = $user->createToken('auth_token')->accessToken;

            // Respon sukses
            return response()->json([
                'status' => true,
                'message' => 'Registrasi pengguna berhasil',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'created_at' => $user->created_at
                    ],
                    'token' => $token
                ]
            ], 201);

        } catch (\Exception $e) {
            // Respon error
            return response()->json([
                'status' => false,
                'message' => 'Registrasi gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }    // POST [email, password]
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email:rfc,dns|max:255',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }

            $token = $user->createToken('auth_token')->accessToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                        'last_login' => now()
                    ],
                    'token' => $token
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    // GET [Auth:Token]
    public function profile(Request $request)
    {
        try {
            // Get authenticated user
            $userData = $request->user();

            // Verify if user exists and is authenticated
            if (!$userData) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            // Return user profile data with success response
            return response()->json([
                'status' => true,
                'message' => 'Profile retrieved successfully',
                'data' => [
                    'user' => [
                        'id' => $userData->id,
                        'name' => $userData->name,
                        'email' => $userData->email,
                        'created_at' => $userData->created_at,
                        'updated_at' => $userData->updated_at
                    ]
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieved  profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    // GET [Auth:Token]
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            "status" => true,
            "message" => "Logged out successfully",
            "Token data" => $token
        ]);
    }

    // Articles Methods
    public function getAllArticles()
    {
        try {
            $articles = Article::with('category')->paginate(10); // 10 items per page
            return response()->json([
                'status' => true,
                'message' => 'Articles retrieved successfully',
                'data' => $articles
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve articles',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getArticle($id)
    {
        try {
            $article = Article::with('category')->findOrFail($id);
            return response()->json([
                'status' => true,
                'message' => 'Article retrieved successfully',
                'data' => $article
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Article not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function createArticle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/articles'), $imageName);
                $imagePath = 'images/articles/' . $imageName;
            }

            // Get the authenticated user's ID
            $userId = auth()->id();

            $article = Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => $userId,
                'image' => $imagePath
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Article created successfully',
                'data' => $article
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create article',
                'error' => $e->getMessage()
            ], 500);
        }
    }    public function updateArticle(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $article = Article::findOrFail($id);

            // Handle image update
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($article->image && file_exists(public_path($article->image))) {
                    unlink(public_path($article->image));
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/articles'), $imageName);
                $article->image = 'images/articles/' . $imageName;
            }

            $article->update([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => auth()->id()
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Article updated successfully',
                'data' => $article
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update article',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function deleteArticle($id)
    {
        try {
            $article = Article::findOrFail($id);

            // Delete associated image if exists
            if ($article->image && file_exists(public_path($article->image))) {
                unlink(public_path($article->image));
            }

            $article->delete();

            return response()->json([
                'status' => true,
                'message' => 'Article deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete article',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Categories Methods
    public function getAllCategories()
    {
        try {
            $categories = Category::with('articles')->get();
            return response()->json([
                'status' => true,
                'message' => 'Categories retrieved successfully',
                'data' => $categories
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve categories',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getCategory($id)
    {
        try {
            $category = Category::with('articles')->findOrFail($id);
            return response()->json([
                'status' => true,
                'message' => 'Category retrieved successfully',
                'data' => $category
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function createCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $category = Category::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Category created successfully',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,'.$id,
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $category = Category::findOrFail($id);
            $category->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully',
                'data' => $category
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json([
                'status' => true,
                'message' => 'Category deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete category',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}


