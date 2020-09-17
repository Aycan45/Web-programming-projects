import axios from 'axios';
import {  deletePostsForAuthor } from './posts.api';

const urlApi="http://localhost:3005";

export function getLoggedUser(){
    return JSON.parse(localStorage.getItem('loggedUser'));
}

export function getAllUsers(){
    return axios.get(`${urlApi}/users`);
}

export function getUserById(id){
    return axios.get(`${urlApi}/users/${id}`);
}
export async function register(userData){
    const users=(await getAllUsers()).data;
    if(users.find(u=>u.email===userData.email))
    {
        throw new Error('Email already exists');
        
    }
    userData={
        ...userData,
        isActive:true,
        isAdmin: false,
        picture:  "https://picsum.photos/200/300?random=4",
    }
    return axios.post(`${urlApi}/users`,userData);
}
export async function login(userData){
    const users=(await getAllUsers()).data;

    const loggedUser=users.find(u=>u.email===userData.email && u.password.toString()===userData.password);

    if(!loggedUser.isActive){
        throw new Error('crrent user has been blocked');
    }

    if(loggedUser){
        localStorage.setItem('loggedUser',JSON.stringify(loggedUser));
        return;
    }

    throw new Error('incorrect username/password');
    
}

export function logout(){
    localStorage.removeItem('loggedUser');  
}

export function saveUser(userData){
    userData.isAdmin= userData.isAdmin==='on';
    if(userData.id){
        return axios.put(`${urlApi}/users/${userData.id}`, userData);
    }
    return register(userData);
}

export function deleteUser(id){
    deletePostsForAuthor(id);
    return axios.delete(`${urlApi}/users/${id}`);
}