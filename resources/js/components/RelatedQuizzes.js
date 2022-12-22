import React from 'react';
import ReactDOM from 'react-dom';
import { useState, useEffect } from "react";
import Quizzes from './Quizzes';



function RelatedQuizzes() {
    
    const [tests,setTests] = useState([]);
    const current_url = window.location.href;
    const current_quiz_slug = (current_url.split("/")).pop();

    useEffect( () => {
       
        const fetchQuizzes = async () => {
            
            const res = await fetch('/api/tests')
            const data = await res.json()

            //setTests(data)

            setTests(data.filter( 
                (test) => test.slug !== current_quiz_slug
             ));
            
        }

      fetchQuizzes()

    }, []);

    // function fetchTests(){

    // }

    return (
        <div className="container">
            <h3>Next Quiz:</h3>
            <div className='row'>
                { 
                    tests.length > 0 ?  <Quizzes tests = {tests} /> : 'No more quizzes found.'
                }
            </div>
        </div>
    );
}

export default RelatedQuizzes;

if (document.getElementById('relatedTests')) {
    ReactDOM.render(<RelatedQuizzes />, document.getElementById('relatedTests'));
}
