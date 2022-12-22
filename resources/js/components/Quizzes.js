import Quiz from './Quiz';

function Quizzes({ tests}){
    return (
        <>
            {tests.map( (test) => 
            (
                <Quiz key={test.id} test={test} />
            )
            )}
        </>
    );
}

export default Quizzes;