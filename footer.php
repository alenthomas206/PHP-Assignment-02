<head>
<style>
footer {
    background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
    color: #fff;
    padding: 2rem 0;
    text-align: center;
    position: relative;
    margin-top: 2rem;
}

footer p {
  margin: 0.25rem 0;
  font-size: 0.95rem;
  opacity: 0.9;
}

footer a {
  color: #ffda79;
  text-decoration: none;
  font-weight: 500;
}

footer a:hover {
  text-decoration: underline;
  color: #fff3cd;
}


footer::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  height: 3px;
  width: 100%;
  background: linear-gradient(90deg, #ffda79, #ff6b6b, #6bcfff);
}
</style>
</head>
<footer class="bg-dark text-light text-center py-3 mt-5">
    <p class="mb-0">&copy; <?= date('Y') ?> Alen Thomas. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
