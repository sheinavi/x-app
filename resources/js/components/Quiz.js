function Quiz({ test}){
    return (
        <div className='col-md-3'>
            <a href={test.url}>
                <div className="card">
                    <div className="card-header"> {test.title} </div>
                    <div className="card-body">
                        <img className="img-thumbnail" src={test.featured_image}  />
                    </div>
                </div>
            </a>
        </div>
    );
}

export default Quiz;