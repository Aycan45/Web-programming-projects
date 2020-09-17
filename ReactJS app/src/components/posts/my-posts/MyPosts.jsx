import React, { useState, useEffect } from 'react';
import { PostCard } from '../post-card/PostCard';
import { getMyPosts } from '../../../core/api/posts.api';

export function MyPosts(){
    const[userPosts, setUserPosts]=useState([]);

    useEffect(()=>{
        getMyPosts().then((posts)=>{
            setUserPosts(posts);
        })
    },[]);


    return(
        <div className="my-posts-wrapper">
            {userPosts.map(post => <PostCard post={post} key={post.id}/>)}
        </div>
    )
}