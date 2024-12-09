Schema::table('categories', function (Blueprint $table) {
    $table->dropColumn('description');  // Remove description column
    $table->foreignId('user_id')->constrained(); // Add user_id foreign key
});
