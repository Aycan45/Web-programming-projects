import React, { useState } from 'react';
import './Login.css';
import {login} from '../../../core/api/users.api';
import { Redirect, Link } from 'react-router-dom';

export function Login(props){

    const [userData, setUserData]=useState({});
    const [isLoggedUser, setLoggedUser]=useState(false);
    const [errorMessage, setErrorMessage]=useState('');
    const onInputChange = (event)=>{
        event.persist();
        console.log(event);

        setUserData((prevState)=>({
            ...prevState,
            [event.target.name]: event.target.value
        }));
        setErrorMessage('');
        console.log(userData);
    }

    const onFormSubmit = (event) =>{
        event.preventDefault();
        login(userData).then(()=>{
            console.log('Login success');
            setLoggedUser(true);
        })
        .catch((err)=>setErrorMessage(err.message));
    };

    return (
        <>
        { isLoggedUser && <Redirect to="/"/> }
        <div className="login-wrapper">
            <h1>Welcome to TouloupBook</h1>
            <form className="login-form" onSubmit={onFormSubmit}>
            { errorMessage && <span className="text-danger">{errorMessage}</span>}
                <div className="form-group">
                    <label htmlFor="email">Email:</label>
                    <input type="email" name="email" id="email" className="form-control" onChange={onInputChange} required/>
                </div>
                <div className="form-group">
                    <label htmlFor="password">Password:</label>
                    <input type="password" name="password" id="password" className="form-control" onChange={onInputChange} required/>
                </div>
                <button className="btn btn-primary">Login</button><br/>
                <Link to="/register">Dont have an account?</Link>
            </form>
        </div>
        </>
    )
}