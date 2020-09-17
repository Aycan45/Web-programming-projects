import React from 'react';
import './UserCard.css';
import { Link } from 'react-router-dom';
import { getLoggedUser } from '../../../core/api/users.api';

const cardStyle={
    width: '18rem',
    borderRadius: '10px'
};

export function UserCard({user, onDelete}){
    const loggedUser=getLoggedUser();


    return(
        <div className="card bg-info m-3" style={cardStyle}>
            <div className="picture-holder">
  <img className="card-img-top" src={user.picture} alt={user.name}/>
  </div>
  <div classNameclass="card-body">
    <h5 className="card-title"><Link to={`/users/${user.id}`}>{user.name}</Link></h5>
  </div>
  <ul className="list-group list-group-primary">
    <li className="list-group-item">Age:{user.age}</li>
    <li className="list-group-item">Email: {user.email}</li>
  </ul>
  <div className="card-body">
      {loggedUser.isAdmin &&  <span className="edit-icon"><Link to={`/users/edit/${user.id}`}>Edit</Link></span>}
        {loggedUser.isAdmin && <div className="cursor-pointer" onClick={()=>onDelete(user.id)}>Delete</div>}
  </div>
    </div>

      //  <div className='user-card'>
        //    <div className="picture-holder">
        //        <span className="edit-icon"><Link to={`/users/edit/${user.id}`}>E</Link></span>
        //        <img src={user.picture} alt={user.name} />
         //   </div>
          //  <div className="info-holder">
         //       <div className="name"><Link to={`/users/${user.id}`}>{user.name}</Link></div>
         //       <div className="email">Email: {user.email}</div>
         //       <div className="age">Age:{user.age}</div>
         //   </div>
            
        //</div>
    )
}