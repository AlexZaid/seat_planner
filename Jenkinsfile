pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'echo Building'
            }
        }
        stage('Test') {
            steps {
                sh 'echo Testing'
            }
        }
        stage('Deploy') {
            input{
                message 'Deploy to production'
                ok 'yes'
            }
            steps {
                sh 'echo Deploying'
            }
        }
    }
}