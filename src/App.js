import React, { Component } from "react";
import Task from "./components/Task";
import DeleteTask from "./components/DeleteTask";
import "./App.css";
export default class App extends Component{
  render(){
    return(
      <div>
        <Task />
        <DeleteTask />
      </div>
    )
  }
}