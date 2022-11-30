import React from 'react';
import axios from 'axios';

export default class Task extends React.Component {
  state = {
    mytask: []
  }
  //submiting task to the database using the api
  handleChange = event => {
    this.setState({ name: event.target.value });
  }

  handleSubmit = event => {
    event.preventDefault();
    const task = {
      name: this.state.name
    };
    console.log(task);

    axios.post(`http://localhost/todoproject/addtasks`,  task , {headers:{'content-type': 'text/json'}})
      .then(res => {
        console.log(res);
        console.log(res.data);
        this.componentDidMount()
      })
      
  }
  //getting tasks from the database through the api
  componentDidMount() {
    axios.get(`http://localhost/todoproject/readtasks`,{headers:{'content-type': 'text/json'}})
      .then(res => {
        const mytask = res.data;
        console.log(mytask);
        this.setState({ mytask });
      })
  }

  render() {
    return (
      <>
      <form onSubmit={this.handleSubmit}>
          <label>
            New Task:
            <input type="text" name="name" onChange={this.handleChange} />
          </label>
          <button type="submit">Add</button>
        </form>
        
      <ul>
        {
          this.state.mytask
          .map(taskitem =>
            <>
              <li key={taskitem.id}>{taskitem.name} <button id='delbutton'>Delete</button></li> 
            </>
            )
        }
      </ul>
      </>
    )
  }
}