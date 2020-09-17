import React, { useState, useEffect } from 'react';
import { PostsList } from '../posts-list/PostsList';
import { savePost, getPostById } from '../../../core/api/posts.api';
import { Redirect } from 'react-router-dom';

export function PostEdit(props){

    const [currentPost, setCurrentPost]=useState({title:'',content:'',authorid:'',authorName:'',data:''});
    const[shouldRedirect, setShouldRedirect]=useState(false);

    useEffect(()=>{
        if(props.computedMatch.params.id){
            getPostById(props.computedMatch.params.id).then((result)=>{
                setCurrentPost(result.data);
            });
        }
    }, [props.computedMatch.params.id])

    const onInputChange=(event)=>{
       event.persist(); 
       setCurrentPost((prevstate)=>({
           ...prevstate,
           [event.target.name]:event.target.value
       }))
    }

    const onPostSave = (event)=>{
        event.preventDefault();
        savePost(currentPost).then(()=>{
            setShouldRedirect(true);
        })
        .catch((err)=>console.error(err));
    }

    return(
        <>
        {shouldRedirect && <Redirect to='/posts'/>}
        <div className="post-edit-wrapper">
            <form onSubmit={onPostSave}>
                <div className="form-group">
                    <label labelfor='title'>Title:</label>
                    <input className="form-control" type="text" id="title" name="title" onChange={onInputChange} value={currentPost.title}/>
                </div>
                <div className="form-group">
                    <label labelfor='content'>Content:</label>
                    <textarea className="form-control" id="content" name="content" onChange={onInputChange} value={currentPost.content}/>
                </div>
                <button className="btn btn-primary">Save post</button>
            </form>
        </div>
        </>
    )
}