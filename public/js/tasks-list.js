let taskApp = () => {
  return { 
      tasks: [], 
      newTask: '',

      submitTask() {
          this.tasks.push({ body: this.newTask, completed: false}); 
          this.newTask = '';
      }  
  };
}   