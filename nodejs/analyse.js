const analyse = (audioFile) => {
  const {exec} = require('child_process');
  return new Promise((resolve, reject) => {
    exec(`python bin/demo.py ../uploads/${audioFile}`, (error, stdout, stderr) => {
      if (error) {
        console.log(`error: ${error.message}`);
        return;
      }
      if (stderr) {
        console.log(`stderr: ${stderr}`);
        return;
      }
      resolve(stdout ? stdout : stderr);
    });
  });
};

module.exports = analyse;