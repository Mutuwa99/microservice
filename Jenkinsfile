pipeline {
    agent any

    environment {
        SONAR_SCANNER_HOME = tool 'sonarqube'
        DOCKER_HUB_CREDENTIALS = credentials('mydocker')
        imagename = 'laravel'
        registry = 'docker.io'
        imageTag = 'latest'
        DOCKER_HUB_USERNAME = 'mutuwa12'

        REMOTE_USER = 'ubuntu'  // Replace with your EC2 instance's username
        SERVER_IP = 'ec2-34-228-36-118.compute-1.amazonaws.com'  // Replace with your EC2 instance's IP
        SSH_CREDENTIALS_ID = 'servekey'

        CONTAINER_NAME = 'laravel_app'  // Replace with your container name
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
                    sh "${SONAR_SCANNER_HOME}/bin/sonar-scanner -Dsonar.projectKey=micro -Dsonar.sources=. -Dsonar.host.url=http://54.174.78.19:9000 -Dsonar.login=429c7d33aff19bb3d6f3873929b789293d095618"
                }
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    // Build and tag Docker image
                    sh "docker build -t ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag} -f frontend/Dockerfile ${WORKSPACE}/frontend"
                }
            }
        }

        stage('Trivy Scan') {
            steps {
                script {
                    // Run Trivy Scan
                    sh "trivy image ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}"
                }
            }
        }

        stage('Push Docker Image to Docker Hub') {
            steps {
                script {
                    // Log in to Docker Hub
                    docker.withRegistry('https://index.docker.io/v1/', 'mydocker') {
                        // Push Docker image to Docker Hub
                        sh "docker push ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}"
                    }
                }
            }
        }

        stage('Deploy to EC2') {
            steps {
                script {
                    // Log in to EC2 instance using SSH key
                    withCredentials([file(credentialsId: SSH_CREDENTIALS_ID, variable: 'SSH_KEY')]) {
                        sh "chmod 600 \$SSH_KEY"
                        sh "ssh -i \$SSH_KEY ${REMOTE_USER}@${SERVER_IP} 'echo Successfully logged in'"
                        
                        // Stop and remove existing container
                        sh "sudo docker stop ${CONTAINER_NAME} || true"
                        sh "sudo docker rm ${CONTAINER_NAME} || true"

                        // Pull the latest image
                        sh "sudo docker pull ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}"

                        // Run a new container
                        sh "sudo docker run -d --name ${CONTAINER_NAME} -p 80:80 ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}"
                    }
                }
            }
        }
    }

    post {
        success {
            echo 'Pipeline successful!'
            // Additional success actions, if needed
        }
        failure {
            echo 'Pipeline failed!'
            // Additional failure actions, if needed
        }
    }
}
