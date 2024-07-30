<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Donation;
use App\Models\GalleryPost;
use Illuminate\Http\Request;

class RegisteredDataController extends Controller
{
    /**
     * Return a paginated list of donations.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDonation(Request $request)
    {
        // Determine the number of items per page from the request or use a default value
        $perPage = $request->get('per_page', 15); // Default to 15 items per page

        // Fetch paginated donations
        $donations = Donation::latest()->paginate($perPage);

        // Return the paginated donations as a JSON response
        return response()->json($donations);
    }

    /**
     * Return a paginated list of gallery.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGallery(Request $request)
    {
        // Determine the number of items per page from the request or use a default value
        $perPage = $request->get('per_page', 15); // Default to 15 items per page

        // Fetch paginated gallery
        $gallery = GalleryPost::latest()->paginate($perPage);

        // Return the paginated gallery as a JSON response
        return response()->json($gallery);
    }

    /**
     * Return a paginated list of BlogPost.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBlogPost(Request $request)
    {
        // Determine the number of items per page from the request or use a default value
        $perPage = $request->get('per_page', 15); // Default to 15 items per page

        // Fetch paginated gallery
        $blogPost = BlogPost::latest()->paginate($perPage);

        // Return the paginated BlogPost as a JSON response
        return response()->json($blogPost);
    }
}
