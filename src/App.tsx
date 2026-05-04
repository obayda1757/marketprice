import { useEffect, useRef } from 'react';

const DASHBOARD_URL = '/dashboard.html';

function App() {
  const iframeRef = useRef<HTMLIFrameElement>(null);

  useEffect(() => {
    if (iframeRef.current) {
      iframeRef.current.style.height = '100vh';
    }
  }, []);

  return (
    <iframe
      ref={iframeRef}
      src={DASHBOARD_URL}
      style={{ width: '100%', height: '100vh', border: 'none', display: 'block' }}
      title="Market Price Dashboard"
    />
  );
}

export default App;
