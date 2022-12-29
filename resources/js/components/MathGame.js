import React from 'react';
import ReactDOM from 'react-dom';
import { useState, useEffect } from "react";
import toastr from 'toastr';
import 'toastr/build/toastr.min.css'


function MathGame() {
    
    const [operand1,setOperand1] = useState(0);
    const [operand2,setOperand2] = useState(0);
    const [score,setScore] = useState(0);
    const operator = '+';
    const [answer,setAnswer] = useState(0);
    const [correctAnswer,setCorrectAnswer] = useState(0);
    let [itemNumber,setItemNumber] = useState(1);

    useEffect( () => {
       
        
            const initValues = async () => {
                generateQuestion();
            }
            
            initValues();
        

    }, [itemNumber]);

    function generateQuestion(){
        let val1 = getRandomInt()
        let val2 = getRandomInt()
        let val_answer = val1 + val2

        setOperand1(val1);
        setOperand2(val2);
        setCorrectAnswer(val_answer);

        document.getElementById("myInput").focus();
    }

    /**
     * Returns a random integer between min (inclusive) and max (inclusive).
     * The value is no lower than min (or the next integer greater than min
     * if min isn't an integer) and no greater than max (or the next integer
     * lower than max if max isn't an integer).
     * Using Math.round() will give you a non-uniform distribution!
     */
    function getRandomInt(min=1, max=99) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function checkAnswer(){
        
        toastr.clear()

        if(correctAnswer == answer){
            setScore(score+1)
            toastr.success(`correct!`)
        }else{
           
            toastr.error(`Sorry, correct answer is ${correctAnswer}`)
        }

        setAnswer(0)

        let i = itemNumber+1;
        setItemNumber(i)

    }

    return (
        <div className="container">
            <div id="questions" className={`${itemNumber < 11 ? 'd-block':'d-none'}`}>
                <div className='d-flex justify-content-between mb-5'>
                    <h3>Question {itemNumber}:  </h3>
                    <h3> Correct Answers: <span className='text-success'>{score}</span> out of {itemNumber}  </h3>
                </div>
                
                <div className='row'>
                    <div className='col-md-8 col-12 text-center'> <p className='display-3'> { operand1 } { operator } { operand2 } =  </p> </div>
                    <div className='col-md-4 col-12 m-auto'>
                        
                        <div className="input-group">
                            <textarea className='form-control' id="myInput" type="number" value={answer} onInput={e => setAnswer(e.target.value)} />
                            <button className="btn btn-primary" onClick={checkAnswer}> Check </button>   
                        </div>                 
                    </div>
                </div>
            </div>

            <div id="results" className={`${itemNumber > 10 ? 'd-block':'d-none'}`}>
                <p class="display-1">You got <span className={`${score > 5 ? 'text-success':'text-danger'}`}>{score}</span> out of {itemNumber-1} </p>
            </div>
            
        </div>
    );
}

export default MathGame;

if (document.getElementById('mathgamecontainer')) {
    ReactDOM.render(<MathGame />, document.getElementById('mathgamecontainer'));
}