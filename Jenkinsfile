pipeline {
    agent any

    environment {
        SONAR_SCANNER_HOME = tool 'sonarqube'
        DOCKER_HUB_CREDENTIALS = credentials('mydocker')
        DOCKER_IMAGE_NAME = 'isaya'
    }

    stages {
        stage('Checkout Code') {
            steps {
                script {
                    checkout scm
                }
            }
        }

        // stage('SonarQube Analysis') {
        //     steps {
        //         script {
        //             sh "${SONAR_SCANNER_HOME}/bin/sonar-scanner -Dsonar.projectKey=mutuwa -Dsonar.sources=. -Dsonar.host.url=http://sonarqube:9000 -Dsonar.login=sqp_20aeae6738aa8d731cada12a6f3031beef7542ee"
        //         }
        //     }
        // }

        stage('Build, Push, and Remove Docker Images') {
            steps {
                script {
                    // Build Docker image
                    def customImage = docker.build("${registry}/${imagename}:${BUILD_NUMBER}")
        
                    // Push the built image to the registry
                    docker.withRegistry('', DOCKER_HUB_CREDENTIALS) {
                        customImage.push('latest')
                        customImage.push("${BUILD_NUMBER}")
                    }
        
                    // Remove unused local Docker images
                    sh "docker rmi ${registry}/${imagename}:${BUILD_NUMBER}"
                    sh "docker rmi ${registry}/${imagename}:latest"
                }
            }
        }


        stage('OWASP Dependency Check') {
            steps {
                script {
                    // Run OWASP Dependency Check
                    sh "docker run --rm ${DOCKER_IMAGE_NAME}:${BUILD_NUMBER} owasp-dependency-check --scan /frontend --format ALL"
                }
            }
        }

        stage('Trivy Scan') {
            steps {
                script {
                    // Run Trivy Scan
                    sh "docker run --rm aquasec/trivy:latest --input ${DOCKER_IMAGE_NAME}:${BUILD_NUMBER} --format json -o trivy_results.json"
                }
            }
        }

        // Other stages...
    }

    post {
        success {
            echo 'Pipeline successful!'
        }
        failure {
            echo 'Pipeline failed!'
        }
    }
}
