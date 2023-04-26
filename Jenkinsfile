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
      		scannerHome = tool 'SonarScanner 2.5'
      	}
      	withSonarQubeEnv(installationName: 'SonarQube') {
      	 sh """/usr/local/bin/sonar-scanner \
      	 -Dsonar.language='php' \
      	 -Dsonar.sourceEncoding='UTF-8' \
      	 -Dsonar.sources='app' \
      	 -D sonar.projectName='firstP'
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


