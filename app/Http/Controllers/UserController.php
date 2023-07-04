<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;

class UserController extends Controller
{
    // list all users
    public function list() {
        // Create a new MongoDB client
        $client = new Client("mongodb://database:27017");

        // Select the database
        $database = $client->laravel;

        // Select the collection
        $collection = $database->users;

        // Find all documents
        $users = $collection->find()->toArray();
        
        return response()->json($users);
    }

    // add user
    public function add(Request $request) {
        // Create a new MongoDB client
        $client = new Client("mongodb://database:27017");

        // Select the database
        $database = $client->laravel;

        // Select the collection
        $collection = $database->users;

        // Insert a new document
        $result = $collection->insertOne([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // check if user was added
        if ($result->getInsertedCount() == 1) {
            $result = [
                'status' => 'success',
                'message' => 'User was added successfully'
            ];
        } else {
            $result = [
                'status' => 'error',
                'message' => 'User was not added'
            ];
        }

        return response()->json($result);
    }
}
