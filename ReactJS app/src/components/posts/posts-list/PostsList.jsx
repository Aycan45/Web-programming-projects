import React, { useState, useEffect } from 'react';
import { getAllPosts,deletePost } from '../../../core/api/posts.api';
import { PostCard } from '../post-card/PostCard';

export function PostsList(){

    const[posts,setPosts]=useState([]);

    useEffect(()=>{
        getAllPosts().then((result)=>{
            setPosts(result.data);
        });
    }, [])

    const onDelete=(id)=>{
        deletePost(id).then(()=>{
            setPosts((prevState)=>{
                return prevState.filter(post => post.id !==id)
            })
        })
    };
    return(
        <div className="posts-list-wrapper" >
            { posts.map(post => <PostCard post={post} key={post.id} onDeleteClick={onDelete} /> )}
        </div>
    );
}