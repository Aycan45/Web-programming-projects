import axios from 'axios';
import { getLoggedUser } from './users.api';

const urlApi="http://localhost:3005"

export function getAllPosts(){
 return axios.get(`${urlApi}/posts`);
}

export function getPostById(id){
    return axios.get(`${urlApi}/posts/${id}`);
}

export async function getPostsByAuthorId(authorId){
    const allPosts=(await getAllPosts()).data;

    return allPosts.filter(post=> post.authorId===authorId);
}

export function getMyPosts(){
    const loggedUserId=getLoggedUser().id;
    return getPostsByAuthorId(loggedUserId);
}


export function savePost(postData){
    const loggedUser=getLoggedUser();

    if(postData.id){
        return axios.put(`${urlApi}/posts/${postData.id}`, postData);
    }

    postData.authorId=loggedUser.id;
    postData.authorName=loggedUser.name;
    postData.date=new Date();

    return axios.post(`${urlApi}/posts`,postData);
}

export function deletePost(id){
    return axios.delete(`${urlApi}/posts/${id}`);
}

export async function deletePostsForAuthor(authorId){
    const posts= (await getPostsByAuthorId(authorId));

    posts.forEach(post=>{
        deletePost(post.id);
    });
}