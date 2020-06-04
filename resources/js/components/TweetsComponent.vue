<template>
<div class="container">
 <div class="row justify-content-center">
        <div class="col-md-12">
           

              
                <div class="card">
                    <div class="card-header">
                     Crear Tweet
                    </div>
                    <div class="card-body">
              
                      <div class="form-group">
                     
                        <textarea class="form-control" id="exampleFormControlTextarea1"
                         rows="3"></textarea>
                      </div>
                    
                      <a href="#" class="btn btn-primary" style="float: right">Crear Tweet</a>
                    </div>
                  </div>
            </div>
        </div>
        <br>
        <div class="card border-info mb-12" >
            <div class="card-header bg-transparent border-info">@diegogonzalez</div>
            <div class="card-body ">
        
              <p class="card-text">orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                   when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            </div>
            <div class="card-footer bg-transparent border-info">
                <span class="badge badge-info">12-12-2012</span>
                <span class="badge badge-success" style="float: right">Editar</span>
                <span class="badge badge-danger" style="float: right">Borrar</span>

            </div>
          </div>
         
          </div>
              
</div>  
         
</template>

<script>
import  axios from 'axios'
    export default {
        data(){
            return {
                tweets:[],
            }
            },
           
            methods: {
                getTweets:function(){
                    var urlTweets='index';
                    axios.get(urlTweets).then(response=>{
                        this.tweets=response.data
                        console.log(this.tweets)
                    })
                }
            },
        
        mounted() {
            console.log('Component mounted.')
                this.getTweets();
        }
    }
</script>
