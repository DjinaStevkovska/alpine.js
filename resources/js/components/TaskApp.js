// window.taskApp = () => {
// for module
export default () => {
    return { 
        tasks: [], 
        newTask: '',
  
        submitTask() {
            this.tasks.push({ body: this.newTask, completed: false}); 
            this.newTask = '';
        }  
    };
  }   