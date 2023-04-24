pipeline {
   agent none
  
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
  }
}

def cleanWs() {
 echo "cleanWs";
}
