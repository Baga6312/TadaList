//imports 
const express = require("express")
const app = express()
const PORT = process.env.PORT || 5000
const cors = require("cors")
require("dotenv").config()
 
const route = require("./routes/ToDoRoutes")

app.use(cors())

app.use(express.json())
app.use(express.urlencoded({ extended: true }))

app.use('/todo', route)

app.listen(PORT, () => {
    console.log(`server is running on port: ${PORT}`)
})
