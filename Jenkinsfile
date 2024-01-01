pipeline {
    agent any

    environment {
        SONAR_SCANNER_HOME = tool 'sonarqube'
        DOCKER_HUB_CREDENTIALS = credentials('mydocker')
        // LINUX_SERVER_CREDENTIALS = credentials('linux-server-credentials-id')
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
                    // Assuming your Docker Compose file is in the root directory
                    sh "docker-compose build"
                    sh "docker-compose push"
                }
            }
        }

        stage('OWASP Dependency Check') {
            steps {
                script {
                    // Assuming your Docker Compose file is in the root directory
                   sh "docker-compose run --rm frontend owasp-dependency-check --scan /frontend --format ALL"
                }
            }
        }

        stage('Trivy Scan') {
            steps {
                script {
                    // Assuming your Docker Compose file is in the root directory
                    sh "docker-compose run --rm trivy-scanner trivy --input ${DOCKER_IMAGE_NAME}:${BUILD_NUMBER} --format json -o trivy_results.json"
                }
            }
        }

        stage('Deploy to Linux Server') {
            when {
                expression { currentBuild.resultIsBetterOrEqualTo('SUCCESS') }
            }
            steps {
                script {
                    // Assuming your Docker Compose file is in the root directory
                    sshagent(credentials: [LINUX_SERVER_CREDENTIALS]) {
                        sh "scp -r . user@linux-server:/path/to/deploy"
                        sh "ssh user@linux-server 'cd /path/to/deploy && docker-compose up -d'"
                    }
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
