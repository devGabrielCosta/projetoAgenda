<template>
  <header>  
    <button @click="logout">Logout</button>
  </header>
  <main>
    <div class="content-delimiter">
        <ScheduleCard :class="'box-shadow fix-size fix-padding'" />
        <InsertScheduleCard v-if="loggedType == 'Receptionist'" :class="'box-shadow fix-size fix-padding'"/>
        <InsertAssessmentCard v-else-if="loggedType == 'Doctor' && selectedSchedule" :class="'box-shadow fix-size fix-padding'"/>
    </div> 
  </main>
</template>

<script>
  import ScheduleCard from '../components/ScheduleCard.vue'
  import InsertScheduleCard from '../components/InsertScheduleCard.vue'
  import InsertAssessmentCard from '../components/InsertAssessmentCard.vue' 
  import { reactive, provide, watchEffect } from 'vue';

  export default {
    data(){
      const viewState = reactive({
        selectedSchedule: null
      })

      provide('viewState', viewState);

      return {
        loggedType: this.$store.getters.getLoggedType,
        selectedSchedule: viewState.selectedSchedule,
        viewState
      }
    },
    mounted(){
      watchEffect(() => {
        this.selectedSchedule = this.viewState.selectedSchedule;
      }) 
    },
		components: {
      ScheduleCard,
      InsertScheduleCard,
      InsertAssessmentCard
		},
    methods: {
      logout(){
        this.$store.dispatch('logout');
        this.selectedSchedule = null;
        this.$router.push('/login');
      }
    }
  }
</script>

<style>

  #app{
    display: flex;
    flex-direction: column;
  }

  header{
    background-color: black;
    height: 4vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  main{
    background-color: rgb(216, 206, 206);
    height: 96vh;
  }

  .content-delimiter{
    width: min(95vw, 1080px);
    height: 100%;
    margin: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;
    gap: 3vh;
  }

  .fix-padding{
    padding: 2vh;
  }

  .fix-size{
    width: 100%;
    height: 40vh;
  }

</style>