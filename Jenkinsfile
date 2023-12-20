pipeline {
    agent any

    environment {
        SONAR_SCANNER_HOME = tool 'sonarqube'
        // Other environment variables...
    }

    stages {
        stage('SonarQube Analysis') {
            steps {
                script {
                    // Run the SonarQube Scanner analysis
                    sh "${SONAR_SCANNER_HOME}/bin/sonar-scanner -Dsonar.projectKey=mutuwa -Dsonar.sources=. -Dsonar.host.url=http://sonarqube:9000 -Dsonar.login=sqp_20aeae6738aa8d731cada12a6f3031beef7542ee"
                }
            }
        }
        // Other stages...
    }

    post {
        success {
            echo 'SonarQube Analysis successful!'
        }
        failure {
            echo 'SonarQube Analysis failed!'
        }
    }
}
