<template>
  <div id="buscamina">
    <div class="principal">
      <tablero/>
    </div>
  </div>
</template>

<script>
import Tablero from './Tablero.vue'

export default {
  name: 'App',
  components: {
    Tablero
  }
}
</script>

<style>
.principal {
 display: grid;
 justify-content: center;
 width: auto;
}

</style>
