import axios from 'axios'

const baseUrl = "http://localhost:5000"

const getAllToDo = (setToDo) => { 
    axios.get(`${baseUrl}/todo`)
    .then(({data}) => {
        console.log('data ---> ',data )
        setToDo(data)
    })
}

const addToDo = (text, setText , setToDo) => {
    axios.post(`${baseUrl}/todo`,{text})
    .then((data)=> { 
        setText("")
        getAllToDo(setToDo)
    })
    .catch((err)=> console.log(err))  
}

const updateToDo = (toDoId ,text ,setTodo ,setText ,setIsUpdating) => {
    axios.put(`${baseUrl}/todo`,{_id: toDoId, text})
    .then((data)=> { 
        setText("")
        setIsUpdating(false)
        getAllToDo(setTodo)
    })
    .catch((err)=> console.log(err))
}

const deleteToDo = (_id , setTodo) => {
    axios.post(`${baseUrl}/todo`,{_id})
    .then((data)=> { 
        getAllToDo(setTodo)
    })
    .catch((err)=> console.log(err))
}

export {getAllToDo ,addToDo , updateToDo, deleteToDo }