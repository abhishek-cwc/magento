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


