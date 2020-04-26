const express = require('express');
const app = express();
const cors = require('cors');
const multer = require('multer');
const crypto = require('crypto');
const port = 5000;
const analyse = require('./analyse');

app.use(cors());

app.use(express.static('public')); // for serving the HTML file

const storage = multer.diskStorage({
  destination: function(req, file, cb) {
    cb(null, './uploads/');
  },
  filename: function(req, file, cb) {
    crypto.pseudoRandomBytes(16, function(err, raw) {
      cb(null, raw.toString('hex') + Date.now() + '.wav');
    });
  },
});

const upload = multer({storage: storage});
const type = upload.single('upl');

app.post('/api', type, async (req, res) => {
  console.log(req.file);

  const percentage = await analyse(req.file.filename);
  if (percentage) {
    res.status(200).json({percentage: percentage});
  } else {
    res.status(500).json({error: 'SERVER_ERROR'});
  }
});

app.listen(port,
    () => console.log(`API Server at http://localhost:${port}`));