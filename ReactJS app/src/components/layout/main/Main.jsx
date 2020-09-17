import React from 'react';
import { Switch, Link, Redirect } from 'react-router-dom';
import {UsersList} from '../../users/users-list/UsersList'
import { User } from '../../users/user/User';
import { AuthenticatedRoute } from '../../../core/guard/AuthenticatedRoute';
import { UserEdit } from '../../users/user-edit/UserEdit';
import { editUser, getLoggedUser } from '../../../core/api/users.api';
import { PostsList } from '../../posts/posts-list/PostsList';
import { PostEdit } from '../../posts/edit/PostEdit';
import { MyPosts } from '../../posts/my-posts/MyPosts';
import './Main.css';

export function Main({ count }){
    return(
        <div className="main-content">
            <Switch>
                <AuthenticatedRoute exact path='/users' component={UsersList}/>
                <AuthenticatedRoute exact path='/users/create' admin={true} component={UserEdit}/>
                <AuthenticatedRoute exact path="/users/edit/:id" admin={true} component={UserEdit} />
                <AuthenticatedRoute exact path='/users/:id' component={User}/>       

                <AuthenticatedRoute  exact path='/posts' component={PostsList}/>
                <AuthenticatedRoute exact path='/posts/my-posts' component={MyPosts}/>
                <AuthenticatedRoute exact path='/posts/create' component={PostEdit} />
                <AuthenticatedRoute exact path='/posts/edit/:id' component={PostEdit}/> 
            </Switch>
        </div>
    );
}

//export const MainComponent= ()=>{
//    return(
//        <div className="main-content">
//            <span>Main content is working</span>
//        </div>
//    );
//}