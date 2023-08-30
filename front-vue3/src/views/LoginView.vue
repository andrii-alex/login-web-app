<template>
  <div>
    <br />
    <el-form ref="loginForm" :model="loginData" label-position="top">
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
          <el-button size="large" @click="login" v-loading.fullscreen.lock="loadingBtn"
            >Log in</el-button
          >
        </el-form-item>
      </el-row>
    </el-form>
  </div>
</template>

<script setup>
import { ElMessage, extractTimeFormat } from 'element-plus'
import { useStore } from 'vuex'
import { inject, ref } from 'vue'

const post = inject('post')

const loginData = ref({
  username: '',
  password: ''
})

const loadingBtn = ref(false)

const loginForm = ref(null)

async function login() {
  loadingBtn.value = true
  loginForm.value.validate(async (valid) => {
    if (!valid) {
      ElMessage({
        message: 'Error',
        type: 'error'
      })
    } else {
      try {
        var response = await post('/login', {
          username: loginData.value.username,
          password: loginData.value.password
        })

        // Perform further actions based on the response if needed
      } catch (error) {
        // Handle any errors that might occur during the login request
        console.error('Login error:', error)
      } finally {
        loadingBtn.value = false // Move this line here
      }
    }
  })
}
</script>
