<template>
  <div>
    <br />
    <el-form :model="loginData" label-position="top">
      <el-form-item
        label="Username"
        label-width="100px"
        prop="username"
        :rules="[
          {
            required: true,
            message: 'Please input username!',
            trigger: 'blur'
          }
        ]"
      >
        <el-input v-model="loginData.username" />
      </el-form-item>
      <el-form-item
        label="Password"
        label-width="100px"
        prop="password"
        :rules="[
          {
            required: true,
            message: 'Please input password!',
            trigger: 'blur'
          }
        ]"
      >
        <el-input v-model="loginData.password" type="password" autocomplete="off" show-password />
      </el-form-item>

      <el-row justify="end">
        <el-form-item>
          <el-button size="large" @click="login">Log in</el-button>
        </el-form-item>
      </el-row>
    </el-form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      loginData: {
        username: '',
        password: ''
      }
    }
  },
  methods: {
    login() {
      var response = axios.post('')

      const store = useStore()
      store.dispatch('login')
    },
    logout() {
      const store = useStore()
      store.dispatch('logout')
    }
  }
}
</script>
