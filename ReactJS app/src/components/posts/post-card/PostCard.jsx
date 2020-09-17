import React from 'react';
import { Link } from 'react-router-dom';
import { getLoggedUser } from '../../../core/api/users.api';
import './PostCard.css';

const PostsCardStyle={
    Width: '70%',
};
const deleteBtnStyles={
    cursor: 'pointer',
    textAlign: 'right',
    float: 'right',
};


export function PostCard({ post, onDeleteClick }){

    const loggedUser=getLoggedUser();

    return(
        <div className="card text-white bg-dark" style={PostsCardStyle}>
        <div className="card-header">
            {<img className="user-image" src={loggedUser.picture}/>}
            {<Link className="usname" to={`/users/${post.authorId}`}>{post.authorName}</Link>}
            {(loggedUser.isAdmin || loggedUser.id===post.authorId) && <Link style={deleteBtnStyles} to={`/posts/edit/${post.id}`}>Edit</Link>} 
            {(loggedUser.isAdmin || loggedUser.id===post.authorId) && <span style={deleteBtnStyles} onClick={()=> onDeleteClick(post.id)}>Delete</span>}
        </div>
        <div className="card-body">
        <p className="card-text">{post.content}</p>
        </div>        
        </div>
    )
}