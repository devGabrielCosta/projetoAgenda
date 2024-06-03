<template>
  <div class="insert-patient-card">  
    <h1>Inserir Paciente</h1>
    <form @submit.prevent="sendForm">
      <label for="name">Nome</label>
      <input type="text" id="name" v-model="name" required> <br/>
      <button class="green" type="submit">Enviar</button>
    </form>
  </div>
</template>

<script>

  export default {
    props: ['parentCallback'],
    data(){
      return {
        name: null
      }
    },
    methods:{     
      sendForm()
      { 
        this.axios
          .post('user', {
            name: this.name,
            type: "Patient"
          })
          .then(response => {
            if(response.data)
            {
              this.$notify({
                text: "Paciente inserido",
                type: "success"
              });
              this.parentCallback();
            }
          })
          .catch(error =>{
              this.$notify({
                text: error.response.data,
                type: "error"
              });
          })
      },
    }
  }

</script>

<style scoped>

  .insert-patient-card{
    background-color: white;

      form {
        margin-top: 2rem;
      
        label {
          display: block;
          margin-bottom: 0.5rem;
        }

        input {
          margin-bottom: 2rem;
        }
      }
  }

</style>
