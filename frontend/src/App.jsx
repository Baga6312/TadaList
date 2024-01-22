import { React ,useState , useEffect } from 'react'
import './App.css'
import Todo from './components/todo'
import { addToDo, deleteToDo, getAllToDo,updateToDo } from './components/handleapi'

function App() {

  const [todo,setTodo] = useState([])
  const [text,setText] = useState("")
  const [isUpdating , setIsUpdating] = useState(false)
  const [toDoId , setToDoId] = useState("")

  useEffect(()=> {
    getAllToDo(setTodo)
  } , [])

  const updateMode = (_id , text ) => { 
    setIsUpdating(true)
    setText(text)
    setToDoId(_id)
  }

  return (
    <div className='App'>
      <div className='container'>
        <h1>ToDo App</h1>
        <div className="top">

          <input 
            type="text" 
            placeholder='Add Todos...'
            value={text}
            onChange={(e)=> setText(e.target.value)}/>
          
          <div className='add'
            onClick={isUpdating
            ? ()=> updateToDo(toDoId ,text ,setTodo ,setText ,setIsUpdating) 
            : ()=> addToDo(text , setText, setTodo)}>
            {isUpdating ? "Update" : "Add" }  
          </div>

        </div>
        <div className="list">
          {todo.length === 0 ? (
          <p>No todos to display.</p>
          ) : (
          <>
          {todo.map((item) => (
          <Todo
            key={item._id}
            text={item.text}
            updateMode={() => updateMode(item._id, item.text)}
            deleteTodo={() => deleteToDo(item._id,setTodo) }
            />
          ))}
          </>
          )}
        </div>
      </div>
    </div>
  )
}

export default App
