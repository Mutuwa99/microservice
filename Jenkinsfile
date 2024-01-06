// pipeline {
//     agent any

//     environment {
//         // SONAR_SCANNER_HOME = tool 'sonarqube'
//         DOCKER_HUB_CREDENTIALS = credentials('mydocker')
//         imagename = 'isaya'
//         registry = 'docker.io'
//     }

//     stages {
//         stage('Checkout Code') {
//             steps {
//                 script {
//                     checkout scm
//                 }
//             }
//         }

//         // stage('SonarQube Analysis') {
//         //     steps {
//         //         script {
//         //             sh "${SONAR_SCANNER_HOME}/bin/sonar-scanner -Dsonar.projectKey=mutuwa -Dsonar.sources=. -Dsonar.host.url=http://sonarqube:9000 -Dsonar.login=sqp_20aeae6738aa8d731cada12a6f3031beef7542ee"
//         //         }
//         //     }
//         // }

//         stage('Build Docker Image') {
//             steps {
//                 script {
//                     // Run Docker-in-Docker
//                     docker.image('docker:dind').inside('-u root') {
//                         // Build and tag Docker image
//                         sh 'docker build -t docker.io/isaya:18 .'
//                     }
//                 }
//             }
//         }

//         // stage('OWASP Dependency Check') {
//         //     steps {
//         //         script {
//         //             // Run OWASP Dependency Check
//         //             sh "docker run --rm ${DOCKER_IMAGE_NAME}:${BUILD_NUMBER} owasp-dependency-check --scan /frontend --format ALL"
//         //         }
//         //     }
//         // }

//         // stage('Trivy Scan') {
//         //     steps {
//         //         script {
//         //             // Run Trivy Scan
//         //             sh "docker run --rm aquasec/trivy:latest --input ${DOCKER_IMAGE_NAME}:${BUILD_NUMBER} --format json -o trivy_results.json"
//         //         }
//         //     }
//         // }

//         // Other stages...
//     }

//     post {
//         success {
//             echo 'Pipeline successful!'
//         }
//         failure {
//             echo 'Pipeline failed!'
//         }
//     }
// }

// pipeline {
//     agent any

//     environment {
//         DOCKER_HUB_CREDENTIALS = credentials('mydocker')
//         imagename = 'isaya'
//         registry = 'docker.io'
//         imageTag = 'latest'
//         DOCKER_HUB_USERNAME = 'mutuwa12'
//     }

//     stages {
//         stage('Checkout Code') {
//             steps {
//                 script {
//                     checkout scm
//                 }
//             }
//         }

//         stage('Build Docker Image') {
//             steps {
//                 script {
//                     // Build and tag Docker image
//                     sh "docker build -t ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag} ."
//                 }
//             }
//         }

//         stage('Push Docker Image to Docker Hub') {
//             steps {
//                 script {
//                     // Log in to Docker Hub
//                     docker.withRegistry('https://index.docker.io/v1/', 'mydocker') {
//                         // Push Docker image to Docker Hub
//                         sh "docker push ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}"
//                     }
//                 }
//             }
//         }

//         // Add other stages as needed...
//     }

//     post {
//         success {
//             echo 'Pipeline successful!'
//         }
//         failure {
//             echo 'Pipeline failed!'
//         }
//     }
// }

// pipeline {
//     agent any

//     environment {
//         DOCKER_HUB_CREDENTIALS = credentials('mydocker')
//         imagename = 'isaya'
//         registry = 'docker.io'
//         imageTag = 'latest'
//         DOCKER_HUB_USERNAME = 'mutuwa12'
//     }

//     stages {
//         stage('Checkout Code') {
//             steps {
//                 script {
//                     checkout scm
//                 }
//             }
//         }

//         stage('Build Docker Image') {
//             steps {
//                 script {
//                     // Build and tag Docker image
//                     sh "docker build -t ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag} ."
//                 }
//             }
//         }

//         stage('Trivy Scan') {
//             steps {
//                 script {
//                     // Run Trivy Scan
//                     sh "trivy image ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}"

//                 }
//             }
//         }

//         stage('OWASP Dependency Check') {
//             steps {
//                 script {
//                     // Run OWASP Dependency Check
//                     dependencyCheckPublisher pattern: 'dependency-check-report.xml'
//                 }
//             }
//         }

//         stage('Push Docker Image to Docker Hub') {
//             steps {
//                 script {
//                     // Log in to Docker Hub
//                     docker.withRegistry('https://index.docker.io/v1/', 'mydocker') {
//                         // Push Docker image to Docker Hub
//                         sh "docker push ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}"
//                     }
//                 }
//             }
//         }

//         // Add other stages as needed...
//     }

//     post {
//         success {
//             echo 'Pipeline successful!'
//         }
//         failure {
//             echo 'Pipeline failed!'
//         }
//     }
// }


// pipeline {
//     agent any

//     environment {
//         SONAR_SCANNER_HOME = tool 'sonarqube'
//         DOCKER_HUB_CREDENTIALS = credentials('mydocker')
//         imagename = 'laravel'
//         registry = 'docker.io'
//         imageTag = 'latest'
//         DOCKER_HUB_USERNAME = 'mutuwa12'
//     }

//     stages {
//         stage('Checkout Code') {
//             steps {
//                 script {
//                     checkout scm
//                 }
//             }
//         }

//         stage('SonarQube Analysis') {
//             steps {
//                 script {
//                     sh "${SONAR_SCANNER_HOME}/bin/sonar-scanner -Dsonar.projectKey=micro -Dsonar.sources=. -Dsonar.host.url=http://54.174.78.19:9000 -Dsonar.login=429c7d33aff19bb3d6f3873929b789293d095618"
//                 }
//             }
//         }

//         stage('Build Docker Image') {
//             steps {
//                 script {
//                     // Build and tag Docker image
//                     // sh "docker build -t ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag} ."
//                     sh "docker build -t ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag} -f frontend/Dockerfile ${WORKSPACE}/frontend"

//                 }
//             }
//         }

//         stage('Trivy Scan') {
//             steps {
//                 script {
//                     // Run Trivy Scan
//                     sh "trivy image ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}"
//                 }
//             }
//         }

//         stage('Push Docker Image to Docker Hub') {
//             steps {
//                 script {
//                     // Log in to Docker Hub
//                     docker.withRegistry('https://index.docker.io/v1/', 'mydocker') {
//                         // Push Docker image to Docker Hub
//                         sh "docker push ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}"
//                     }
//                 }
//             }
//         }
//     }

//     post {
//         success {
//             echo 'Pipeline successful!'
//             // Additional success actions, if needed
//         }
//         failure {
//             echo 'Pipeline failed!'
//             // Additional failure actions, if needed
//         }
//     }
// }

pipeline {
    agent any

    environment {
        SONAR_SCANNER_HOME = tool 'sonarqube'
        DOCKER_HUB_CREDENTIALS = credentials('mydocker')
        imagename = 'laravel'
        registry = 'docker.io'
        imageTag = 'latest'
        DOCKER_HUB_USERNAME = 'mutuwa12'
        EC2_INSTANCE_IP = 'ec2-100-25-218-179.compute-1.amazonaws.com'
        EC2_INSTANCE_USERNAME = 'ubuntu' // Update with your Ubuntu instance username
        SSH_CREDENTIALS_ID = 'mysite' // Replace with your SSH key credential ID
        CONTAINER_NAME = 'laravel_container' // Replace with your desired container name
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
                    sh "docker build -t ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag} -f frontend/Dockerfile ${WORKSPACE}/frontend"
                }
            }
        }

        stage('Trivy Scan') {
            steps {
                script {
                    sh "trivy image ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}"
                }
            }
        }

        stage('Push Docker Image to Docker Hub') {
            steps {
                script {
                    docker.withRegistry('https://index.docker.io/v1/', 'mydocker') {
                        sh "docker push ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}"
                    }
                }
            }
        }

        stage('Deploy to Ubuntu Server') {
            steps {
                script {
                    withCredentials([file(credentialsId: SSH_CREDENTIALS_ID, variable: 'SSH_KEY')]) {
                        writeFile file: 'ssh-key', text: SSH_KEY
                        sh 'chmod 600 ssh-key'

                        sh "scp -i ssh-key frontend/Dockerfile ${EC2_INSTANCE_USERNAME}@${EC2_INSTANCE_IP}:/tmp/Dockerfile"
                        sh "scp -i ssh-key frontend/.dockerignore ${EC2_INSTANCE_USERNAME}@${EC2_INSTANCE_IP}:/tmp/.dockerignore"

                        sshCommand remote: "${EC2_INSTANCE_USERNAME}@${EC2_INSTANCE_IP}", credentials: [SSH_CREDENTIALS_ID], command: """
                            sudo docker stop ${CONTAINER_NAME}
                            sudo docker rm ${CONTAINER_NAME}
                            sudo docker pull ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}
                            sudo docker run -d --name ${CONTAINER_NAME} -p 80:80 ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag}
                        """
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


