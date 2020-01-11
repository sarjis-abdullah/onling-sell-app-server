<?php
/**
 * Created by PhpStorm.
 * User: Sarjis Abdullah
 * Date: 11/01/2020
 * Time: 02:22 PM
 */

namespace App\Http\Repositories\Post;


use App\Post;

class PostRepository implements PostRepositoryInterface
{
    public function search($request){
        if ($request->categoryId !== null) {
            if ($request->landRange[0] > 0 && $request->landRange[1] > $request->landRange[0]) {
                if ($request->flatRange[0] > 0 && $request->flatRange[1] > $request->flatRange[0]) {
                    if ($request->minPrice < $request->maxPrice) {
                        if ($request->bedRoomNumber != null) {
                            if ($request->bathRoomNumber != null){
                                return Post::whereBetween('landRange', [$request->landRange[0], $request->landRange[1]])
                                    ->whereBetween('flatRange', [$request->flatRange[0], $request->flatRange[1]])
                                    ->whereBetween('price', [$request->minPrice, $request->maxPrice])
                                    ->where('category_id', $request->categoryId)
                                    ->where('numberOfBed', $request->bedRoomNumber)
                                    ->where('numberOfBath', $request->bathRoomNumber)
                                    ->orderBy('created_at', 'DESC')
                                    ->paginate(10);
                            }else{
                                return Post::whereBetween('landRange', [$request->landRange[0], $request->landRange[1]])
                                    ->whereBetween('flatRange', [$request->flatRange[0], $request->flatRange[1]])
                                    ->whereBetween('price', [$request->minPrice, $request->maxPrice])
                                    ->where('category_id', $request->categoryId)
                                    ->where('numberOfBed', $request->bedRoomNumber)
                                    ->orderBy('created_at', 'DESC')
                                    ->paginate(10);
                            }
                        } else if ($request->bathRoomNumber != null){
                            return Post::whereBetween('landRange', [$request->landRange[0], $request->landRange[1]])
                                ->whereBetween('flatRange', [$request->flatRange[0], $request->flatRange[1]])
                                ->whereBetween('price', [$request->minPrice, $request->maxPrice])
                                ->where('numberOfBath', $request->bathRoomNumber)
                                ->where('category_id', $request->categoryId)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);
                        }else{
                            return Post::whereBetween('landRange', [$request->landRange[0], $request->landRange[1]])
                                ->whereBetween('flatRange', [$request->flatRange[0], $request->flatRange[1]])
                                ->whereBetween('price', [$request->minPrice, $request->maxPrice])
                                ->where('category_id', $request->categoryId)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);
                        }
                    } else {
                        return Post::whereBetween('landRange', [$request->landRange[0], $request->landRange[1]])
                            ->whereBetween('flatRange', [$request->flatRange[0], $request->flatRange[1]])
                            ->where('category_id', $request->categoryId)
                            ->orderBy('created_at', 'DESC')
                            ->paginate(5);
                    }
                } else {
                    return Post::whereBetween('landRange', [$request->landRange[0], $request->landRange[1]])
                        ->where('category_id', $request->categoryId)
                        ->orderBy('created_at', 'DESC')
                        ->paginate(5);
                }
            } else {
                return Post::where('category_id', $request->categoryId)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(5);
            }
        } else {
            return Post::orderBy('created_at', 'DESC')->paginate(5);
        }
    }

    /**
     *
     */
    public function update(){

    }
}