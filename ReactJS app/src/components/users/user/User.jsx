import React,{Component} from 'react';
import { getUserById } from '../../../core/api/users.api';
import { UserCard } from '../user-card/UserCard';
import { getPostsByAuthorId } from '../../../core/api/posts.api';
import { PostCard } from '../../posts/post-card/PostCard';

export class User extends Component{
    constructor(props){
        super(props);

        this.state={
            user: {},
            posts: []
        };
    }

    componentDidMount(){
        console.log(this.props);
        getUserById(this.props.computedMatch.params.id).then((response)=>{
            this.setState({
                user: response.data
            });
        });

        getPostsByAuthorId(this.props.computedMatch.params.id).then((post)=>{
            this.setState({
                post
            });
        });
    }
    render(){
        return(
            <div className='single-user'>
                <UserCard user={this.state.user}/>
                {this.state.posts.map(post=> <PostCard prop={post} key={post.id}/>)}
            </div>
        )
    }
}