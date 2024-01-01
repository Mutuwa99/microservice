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

    stages {
        stage('Build Docker Image') {
            steps {
                script {
                    // Run Docker-in-Docker
                    docker.image('docker:dind').inside('-u root') {
                        // Build and tag Docker image
                        sh 'docker build -t isaya:10 .'
                    }
                }
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
