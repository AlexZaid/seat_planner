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
                sh 'ssh tegl@10.105.174.6 -o StrictHostKeyChecking=no "bash /home/tegl/cicdJobs/cicdLayout.sh testing"'
            }
        }
        stage('Deploy') {
            /// input{
            // /  ///  message 'Deploy to production'
            //     ok 'yes of course'
            // }
            steps {
                sh 'echo Deploying'
                sh 'ssh tegl@10.105.174.6 -o StrictHostKeyChecking=no "bash /home/tegl/cicdJobs/cicdLayout.sh deployment"'
            }
        }
    }
}