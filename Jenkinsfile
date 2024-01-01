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

        stage('SonarQube Analysis') {
            steps {
                script {
                    sh "${SONAR_SCANNER_HOME}/bin/sonar-scanner -Dsonar.projectKey=mutuwa -Dsonar.sources=. -Dsonar.host.url=http://sonarqube:9000 -Dsonar.login=sqp_20aeae6738aa8d731cada12a6f3031beef7542ee"
                }
            }
        }

        stage('Build and Push Docker Image') {
            steps {
                script {
                    // Build and tag the Docker image
                    sh "docker build -t ${DOCKER_IMAGE_NAME}:${BUILD_NUMBER} ."
                    
                    // Log in to Docker Hub
                    sh "docker login -u ${DOCKER_HUB_CREDENTIALS_USR} -p ${DOCKER_HUB_CREDENTIALS_PSW}"

                    // Push the Docker image to Docker Hub
                    sh "docker push ${DOCKER_IMAGE_NAME}:${BUILD_NUMBER}"
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
