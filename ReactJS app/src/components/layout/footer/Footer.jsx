import React from 'react';

const style={
backgroundColor: '#343a40',
width: '100%',
position: 'fixed',
height: '50px',
bottom:'0',
color: 'darkturquoise',
fontWeight: 'bold',
fontFamily: 'Arial'
};

export function Footer(){
    return(
        <footer className="page-footer font-small blue" style={style}>
            ToulopBook 2020 All rights reserved
        </footer>
    );
}