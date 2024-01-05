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


pipeline {
    agent any

    environment {
        DOCKER_HUB_CREDENTIALS = credentials('mydocker')
        imagename = 'isaya'
        registry = 'docker.io'
        imageTag = 'latest'
        DOCKER_HUB_USERNAME = 'mutuwa12'
    }

    stages {
        stage('Checkout Code') {
            steps {
                script {
                    checkout scm
                }
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    // Build and tag Docker image
                    sh "docker build -t ${registry}/${DOCKER_HUB_USERNAME}/${imagename}:${imageTag} ."
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

        stage('OWASP Dependency Check') {
            steps {
                script {
                    // Run OWASP Dependency Check using the Jenkins workspace
                    sh "dependency-check.sh --scan ${WORKSPACE} --format XML -f dependency-check-report.xml"
                    
                    // Archive Dependency-Check report as an artifact
                    archiveArtifacts 'dependency-check-report.xml'
                    
                    // Publish Dependency-Check results in Jenkins
                    dependencyCheckPublisher pattern: 'dependency-check-report.xml'
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

