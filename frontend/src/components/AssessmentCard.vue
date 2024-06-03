<template>
  <div class="insertScheduleCard">  
    <h2>
      Atendimento {{ selectedSchedule?.id }} <template v-if="isDoctor"> - {{ selectedSchedule.patient.name }}</template>
      <button @click="patientNoShow" v-if="showInsertFunctions">Não compareceu</button>
    </h2>
    <form @submit.prevent="sendForm">
      <label for="comment">Texto da avaliação</label>
      <textarea id="comment" v-model="comment" v-if="showInsertFunctions"></textarea>
      <textarea id="comment" v-model="textAreaValue" :disabled="true" v-else></textarea>
      <button type="submit" v-if="showInsertFunctions">Enviar</button>
    </form>
  </div>
</template>

<script>

  import { inject } from 'vue';

  export default {
    props: ['scheduleId'],
    data() {
      const viewState = inject('viewState');

      return {
        comment: null,
        viewState,      
      };
    }, 
    computed: {
      loggedType() { 
        return this.$store.getters.getLoggedType;
      },
      isDoctor() { 
        return this.loggedType == 'Doctor';
      },
      showInsertFunctions() { 
        return this.isDoctor && this.selectedSchedule?.status == 'Created';
      },
      isReceptionist() { 
        return this.loggedType == 'Receptionist';
      },
      selectedSchedule() { 
        return this.viewState.selectedSchedule;
      },
      textAreaValue(){
        return this.selectedSchedule?.assessment?.comment
      }
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
        this.viewState.reloadScheduleCard = true;
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
