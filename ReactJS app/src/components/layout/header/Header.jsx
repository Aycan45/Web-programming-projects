import React, { useState } from 'react';
import {Link, Redirect} from 'react-router-dom';
import { logout, getLoggedUser } from '../../../core/api/users.api';



export function Header(){

    const[isLoggedOut, setLogoutFlag]=useState(false);

    const onLogout = (event) =>{
        logout();
        setLogoutFlag(true);
    }
    const loggedUser=getLoggedUser();

    return(
        <>
        { isLoggedOut && <Redirect to='/login' /> }
        <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
            <a className="navbar-brand" href="#"><div className="user">
                {!isLoggedOut && (<img  className="user-image" src={loggedUser.picture}/>)}
                {!isLoggedOut && (<p class="username"><Link to={`/users/${loggedUser.id}`}>{loggedUser.name}</Link></p>)}
            </div></a>
                <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
        <div className="collapse navbar-collapse" id="navbarNav">
            <ul className="navbar-nav">
                <li className="nav-item active">
                    <Link to='/' className="nav-link">Home</Link>
                </li>
                <li class="nav-item">
                    <Link to='/users' className="nav-link">Users</Link>
                </li>
                <li className="nav-item">
                <Link to='/users/create' className="nav-link">Create</Link>
                </li>
                <li className="nav-item">
                <Link to='/posts/my-posts' className="nav-link">My timeline</Link>
                </li>
                <li className="nav-item">
                <Link to='/posts' className="nav-link">Newsfeed</Link>
                </li>
                <li className="nav-item">
                <Link to='/posts/create' className="nav-link">Create post</Link>
                </li>
            </ul>
            <span className="logout-btn" onClick={onLogout}>Logout</span>         
        </div>
        <span className="name">TouloupBook</span>
    </nav>
    </>
    );
}