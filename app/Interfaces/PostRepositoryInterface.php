<?php
namespace App\Interfaces;

interface PostRepositoryInterface {
    public function getAllPosts();
    public function getPostById($PostId);
    public function deletePost($PostId);
    public function createPost(array $PostDetails);
    public function updatePost($PostId, array $newDetails);
}