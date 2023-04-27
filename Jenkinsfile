pipeline {
   agent any
  
  environment {
    MYSQL_HOST          = 'db'
    MYSQL_USER          = 'root'
    MYSQL_PASSWORD      = 'Abhishek@123'
    MAGENTO_URL         = 'http://local.secondp.com'
  }
  
  stages {
  
    stage('clean WS') {
      steps {
      	cleanWs() 
      }
    }	
    
    stage('SonarQube Scan') {
      steps {
       script {
      		scannerHome = tool 'SonarScanner 4.7'
      	}
      	withSonarQubeEnv(installationName: 'SonarQube') {

      	 sh """/home/abhishek/.sonar/sonar-scanner-4.7.0.2747-linux/bin/sonar-scanner \
      	 -Dsonar.projectKey=firstp \
  	-Dsonar.projectBaseDir=/var/www/html/firstp/app/code \
  	-Dsonar.sources=/var/www/html/firstp/app/code \
  	-Dsonar.login=sqp_d32308828005ebaedf2a6a40fc52ce7dfd43a0f6 \
  	-Dsonar.host.url=http://localhost:9000
      	 """	
      	}
      	
      }
    }
    
    stage('Deploy Code') {
          steps {
            deployCode()
          }
        }
        
    } 
}

def cleanWs() {
 echo "cleanWs";
}

def deployCode() {
 sh '''
 #php /usr/local/bin/composer install --no-dev
 echo "start magento command"
 php bin/magento setup:upgrade
 php bin/magento setup:di:compile
 '''
}


