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
    
    stage('PHP Code Scan') {
      steps {
      	// create folder to save report output
      	sh 'mkdir -p build/reports'
      	phpUnit()
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
  	-Dsonar.projectBaseDir=/var/lib/jenkins/workspace/firstp/app/code \
  	-Dsonar.sources=/var/lib/jenkins/workspace/firstp/app/code/Webkul \
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


def phpUnit() {
 echo "start php unit";
 sh './vendor/bin/phpunit -d memory_limit=-1 --testbox-html `pwd`/build/reports/phpunit.html -c phpunit.xml.dist --coverage-clover `pwd`/build/reports/coverage.xml --log-junit=`pwd`/build/reports/exceution-reports.xml || exit 0'
}

def cleanWs() {
 echo "cleanWs";
}

def deployCode() {
 sh '''
 #php /usr/local/bin/composer install --no-dev
 echo "start magento command"
 #php -d memory_limmit=-1 bin/magento setup:upgrade
 #php -d memory_limmit=-1 bin/magento setup:di:compile
 '''
}


