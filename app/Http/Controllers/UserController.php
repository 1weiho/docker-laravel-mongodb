<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;

class UserController extends Controller
{
    public function index()
    {
        // Create a new MongoDB client
        $client = new Client("mongodb://database:27017");

        // Select the database
        $database = $client->laravel;

        // Select the collection
        $collection = $database->users;

        // Insert a new document
        $result = $collection->insertOne([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('secret'),
        ]);

        // Find all documents
        $users = $collection->find();

        // Display the users
        foreach ($users as $user) {
            echo $user['name'] . ' - ' . $user['email'] . '<br>';
        }
    }
}
