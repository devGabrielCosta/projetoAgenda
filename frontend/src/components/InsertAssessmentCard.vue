<template>
  <div class="insertScheduleCard">  
    <h2>Atendimento {{ selectedSchedule?.id }}<button @click="patientNoShow">Não compareceu</button></h2>
    <form @submit.prevent="sendForm">
      <label for="comment">Texto da avaliação</label>
      <textarea id="comment" v-model="comment"></textarea>
      <button type="submit">Enviar</button>
    </form>
  </div>
</template>

<script>

  import { watchEffect, inject } from 'vue';

  export default {
    props: ['scheduleId'],
    data() {
      const viewState = inject('viewState');

      return {
        comment: null,
        selectedSchedule: null,
        viewState
      };
    },  
    mounted(){
      watchEffect(() => {
        this.selectedSchedule = this.viewState.selectedSchedule;
      }) 
    },
    methods: {
      sendForm()
      { 
        this.axios
          .post('assessment', {
            schedule_id: this.selectedSchedule.id,
            comment: this.comment
          })
          .then(response => {
            if(response.data)
              this.changeStateSchedule(null);
          })
      },
      patientNoShow(){
        this.axios
          .patch('schedule/'+this.selectedSchedule.id, {
            status: 'NoShow'
          })
          .then(response => {
            if(response.data)
              this.changeStateSchedule(null);
          })
      },
      changeStateSchedule(schedule){
        this.viewState.selectedSchedule = schedule
      }
    }
  }
  
</script>

<style scoped>

  .insertScheduleCard{
    background-color: white;

      h2{
        width: 100%;
        display: flex;
        justify-content: space-between;
      }

      form {
      margin-top: 20px;
      }
      label {
        display: block;
        margin-bottom: 5px;
      }
      textarea {
        width: 100%;
        min-height: 150px;
        padding: 5px;
        margin-bottom: 10px;
        resize: none;
      }
      button:hover {
        background-color: #0056b3;
      }
  }

</style>
