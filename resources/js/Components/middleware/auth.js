import { getData } from '../plugins/axios';

const SESSION_TIMEOUT = 10 * 60 * 1000; // 10 minutes
let sessionTimeout;
let lastActivityTime = Date.now();

// Reset activity timer on user interaction
export const initSessionTimeout = () => {
  const resetTimer = () => {
    lastActivityTime = Date.now();
    clearTimeout(sessionTimeout);
    sessionTimeout = setTimeout(() => {
      handleSessionExpiry();
    }, SESSION_TIMEOUT);
  };

  // Add event listeners for user activity
  if (typeof window !== 'undefined') {
    ['mousedown', 'keydown', 'scroll', 'touchstart', 'click'].forEach(event => {
      window.addEventListener(event, resetTimer, true);
    });
  }

  // Start initial timeout
  resetTimer();
};

// Clear session on expiry
export const handleSessionExpiry = () => {
  localStorage.removeItem('token');
  localStorage.removeItem('user');
  window.location.href = '/admin/login?session_expired=true';
};

// Verify token with server
export const verifyToken = async () => {
  try {
    const token = localStorage.getItem('token');
    if (!token) return false;

    const response = await getData('/me');
    return !!response;
  } catch (error) {
    return false;
  }
};

// Check if user is authenticated
export const isUserAuthenticated = () => {
  const token = localStorage.getItem('token');
  return !!token;
};

export default {
  initSessionTimeout,
  handleSessionExpiry,
  verifyToken,
  isUserAuthenticated,
};
